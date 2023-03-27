
let dateEdit = document.querySelector('#newDateTrain').value;
let countDownDate = new Date (dateEdit).getTime();
const text = document.querySelector('#container_dateTrain');

let x = setInterval(
    function(){
        let now = new Date().getTime();

        let distance = countDownDate - now;
        const days = Math.floor(distance /(1000 * 60 * 60 * 24));
        const hours = Math.floor((distance%(1000 *60 * 60 *24 ))/(1000 * 60 *60));
        const minutes = Math.floor((distance%(1000*60*60))/(1000*60));
        const seconds = Math.floor((distance%(1000*60))/ 1000);
        // console.log(days , hours , minutes, seconds);
        text.innerHTML = `${days}j ${hours}H ${minutes}min ${seconds}s `;
    }
)





