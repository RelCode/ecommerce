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