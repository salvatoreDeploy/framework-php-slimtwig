/*Teste de utilização do axios comunicação entre front e back*/

let btn_subscribe = document.querySelector('#btn_subscribe');

btn_subscribe.onclick = async () => {
    //console.log('subscribe');
    axios.post('index.php/user/subscribe').then((response)=>{
        console.log(response.data);
    })
}