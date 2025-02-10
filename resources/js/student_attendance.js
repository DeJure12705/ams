import axios from "axios";

console.log('Dev Console ------------ Attendance Page');

let attendanceStart = false;


const form = document.getElementById('attendanceForm');

async function post(form){
    let isRecorded = false;
    const response = await axios.post(form.get('uri'), form, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    });
    document.querySelector('#inputField').value = "";


    return isRecorded;
}


// PREVENT THE FORM FROM SUBMITTING AND REDIRECTING TO A PAGE
 form.addEventListener('submit',event=>{
    event.preventDefault();
   let isRecorded = post(new FormData(event.target));
    // notify(isRecorded, "")
    let isFetch = setTimeout(get(), 500);
    // notify(isFetch, "")
});

// LOAD THE TABLE => GET
async function get(){
    let uri = document.getElementById('getURI').value
    let isFetch = false
   const data= await axios.get(uri)

    return data;
}

// FOR NOTIFICATIONS ETC

function notify(status, content){

}

function error(status, content){

}

setInterval( ()=>{
    document.querySelector('#inputField').focus()
    console.log('hello world ')
}, 500)


