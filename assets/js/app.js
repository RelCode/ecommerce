var navHeight = document.getElementsByTagName('nav')[0].clientHeight;
document.getElementById('main-container').style.height = 'calc(100% - '+navHeight+'px)'
document.getElementById('main-container').style.top = navHeight+'px'
var xmlHttp = new XMLHttpRequest();
var actionUrl = './library/actions.php';

var form = document.getElementById('form');
if(form){
    form.addEventListener('submit',function(e) {
        const inputFields = document.querySelectorAll('.must-fill')
        let valid = true;
        for (let i = 0; i < inputFields.length; i++) {
            if(inputFields[i].value == ''){
                if(valid) valid = !valid; e.preventDefault(); //valid == true, make it false first
                if(inputFields[i].id == 'categories'){
                    document.getElementsByClassName('cat-header')[0].classList.add('no-text')
                    setTimeout(() => {
                        document.getElementsByClassName('cat-header')[0].classList.remove('no-text')
                    }, 2500);
                }else{
                    inputFields[i].classList.add('no-value')
                    setTimeout(() => {
                        inputFields[i].classList.remove('no-value')
                    }, 2500);
                }
            }
        }
    })
}
//after DOM has loaded, fetch items in a cart
window.onload = function(){
    let cartCount = document.getElementById('cart-count');
    xmlHttp.onreadystatechange = function(){
        // if cart has at least one item, badge class must be set to 'warning' else 'secondary'
        xmlHttp.response > 0 ? cartCount.classList.add('badge-warning') : cartCount.classList.add('badge-secondary');
        cartCount.innerText = xmlHttp.responseText;
    }
    xmlHttp.open('GET',actionUrl + '?action=cartItemsCount');
    xmlHttp.send();
}

//navbar search product feature
search = document.getElementById('search');
search.addEventListener('keyup',function(){
    let string = this.value;
    if(string != ''){
        this.closest('form').action = '/ecommerce/search/?query='+string;
        console.log(this.closest('form'));
    }
})
//countryProvinceCity API
var selectLocations = document.querySelectorAll('.location');
if(selectLocations){
    for(const selected of selectLocations){
        selected.addEventListener('change',function(){
            if(this.id == 'country'){
                if(this.value == 'south africa'){
                    //args(valuesToFetch,selectFieldToPopulate)
                    fetchLocationValues('fetchProvinces','province');
                }else{
                    selectLocations[1].innerHTML = '';
                    selectLocations[2].innerHTML = '';
                }
            }else if(this.id == 'province'){
                if(this.value != ''){
                    fetchLocationValues('fetchCities','city',this.value)
                }else{
                    selectLocations[2].innerHTML = '';
                }
            }
        })
    }
}

function fetchLocationValues(action,selectField,where = null){
    xmlHttp.onreadystatechange = function(){
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200){
            var opts = '<option value=""></option>';
            if(xmlHttp.responseText.length > 0){
                JSON.parse(xmlHttp.responseText).forEach((locationValue,index) => {
                    opts += '<option value="'+locationValue.id+'">'+locationValue.name+'</option>';
                });
                document.getElementById(selectField).innerHTML = opts;
            }else{
                document.getElementById(selectField).innerHTML = opts;
            }
        }
    }
    xmlHttp.open('GET',actionUrl+'?action='+action+'&where='+where);
    xmlHttp.send();
}

var stepbtn = document.getElementsByClassName('stepper-btn')[0];
if(stepbtn){
    stepbtn.addEventListener('click',function(){
        if(stepbtn.id == 1){
            document.getElementsByClassName('stepper-step-1')[0].classList.add('d-none');
            stepForward();
        }else if(stepbtn.id == 2){
            document.getElementsByClassName('stepper-step-2')[0].classList.add('d-none');
            stepBack();
        }
    })
}

function stepForward(){
    stepbtn.id = 2;
    stepbtn.innerText = 'Back';
    document.getElementsByClassName('stepper-step-2')[0].classList.remove('d-none');
    document.getElementsByClassName('step-2')[0].classList.add('bg-primary');
}

function stepBack(){
    stepbtn.id = 1;
    stepbtn.innerText = 'Next';
    document.getElementsByClassName('stepper-step-1')[0].classList.remove('d-none');
    document.getElementsByClassName('step-2')[0].classList.remove('bg-primary');
}

var bankSelect = document.getElementById('bank');
if(bankSelect){
    var banks = {
        'ABSA':'632005',
        'Bank of Athens':'410506',
        'Bidvest Bank':'462005',
        'Capitec Bank':'740010',
        'FNB':'250655',
        'Investec':'580105',
        'Nedbank':'198765',
        'SA Post Bank':'460005',
        'Standard Bank':'051001'
    }
    var bankOpts = '<option></option>';
    for(const [key,value] of Object.entries(banks)){
        bankOpts += '<option value='+value+'>'+key+'</option>';
    }
    bankSelect.innerHTML = bankOpts;

    bankSelect.addEventListener('change',function(){
        if(bankSelect.value != ''){
            document.getElementById('branch').value = bankSelect.value;
            document.getElementsByClassName('branch')[0].value = bankSelect;
        }else{
            document.getElementById('branch').value = '';
            document.getElementsByClassName('branch')[0].value = bankSelect;
        }
    })
}
// window.onload = function(){
//     xmlHttp.onreadystatechange = function(){
//         console.log(xmlHttp);
//     }
//     xmlHttp.open("GET", "https://www.universal-tutorial.com/api/getaccesstoken");
//     xmlHttp.setRequestHeader("content-type", "application/x-www-form-urlencoded",{
//         "api-token": "mb8efL-cwe2rUTcBLxFlL80okqb9xT0bUoyAKuoFJ0ui-56honWEgGmaapMvzFopVJo",
//         "user-email": "princefana7@gmail.com"
//     });
//     xmlHttp.send();

//     // console.log(req);
// }