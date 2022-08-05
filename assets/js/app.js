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