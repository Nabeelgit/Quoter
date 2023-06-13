const submit_btn = document.getElementById('submit-btn');
const submit_box = document.querySelector('.submit-box');

submit_btn.addEventListener("click", function(){
    if(submit_box.classList.contains('no-display')){
        submit_box.classList.remove('no-display');
    }
})

document.getElementById('submit-close').addEventListener('click', function(){
    submit_box.classList.add('no-display');
})

function post(to, body, func){
    let xml = new XMLHttpRequest();
    xml.addEventListener('readystatechange', function (){
        if(xml.status === 200 && xml.readyState === 4){
            func(xml.responseText);
        }
    })
    xml.open('POST', to, true)
    xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xml.send(body);
}

function removeQuotes(str) {
    if ((str.startsWith("'") && str.endsWith("'")) ||(str.startsWith('"') && str.endsWith('"'))) {
      return str.slice(1, -1);
    }
    return str;
}

document.getElementById('quote_submit_btn').addEventListener('click', function(e){
    e.preventDefault();
    let quote_text = removeQuotes(document.getElementById('quote_text_submit').value.trim());
    let quote_author = document.getElementById('quote_author').value.trim();
    if(quote_text !== '' && quote_author !== ''){
        post('./submit.php', 'submit=t&text='+encodeURIComponent(quote_text)+'&author='+encodeURIComponent(quote_author), function(res){
            switch(res) {
                case "0":
                    window.location.reload();
                break;
                case "1":
                    alert('Quote already exists!');
                break;
                default:
                    alert('Couldn\'t submit quote... Try again later.');
                break;
            }
        });
        submit_box.classList.add('no-display');
    }
})