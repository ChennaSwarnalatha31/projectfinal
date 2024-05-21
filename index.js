function submitFeedback(event) {
    event.preventDefault(); 

    
    const year = document.getElementById('year').value;
    const semester = document.getElementById('semester').value;
    const branch = document.getElementById('branch').value;
    const section = document.getElementById('section').value;
   

   
    document.getElementById('feedbackForm').reset();
}

function adminLogin() {
    
    console.log("Admin login clicked.");
}