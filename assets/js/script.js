
function validateForm() {
    var name = document.getElementById("name_input").value;
    var photo = document.getElementById("photo_input").files.length;
    var club = document.getElementById("clubSelect").value;
    var logoClub = document.getElementById("logo_club").files.length;
    var rating = document.getElementById("rating_input").value;
    var pace = document.getElementById("pace_input").value;
    var dribbling = document.getElementById("dribbling_input").value;
    var passing = document.getElementById("passing_input").value;
    var shooting = document.getElementById("shooting_input").value;
    var defending = document.getElementById("defending_input").value;
    var physical = document.getElementById("physical_input").value;

    if (name === "") {
        alert("Name is required.");
        return false;
    }

    var nameRegex = /^[a-zA-Z\s]+$/; 
    if (!nameRegex.test(name)) {
        alert("Name must be a valid string !");
        return false;
    }

    if (photo === 0) {
        alert("Photo is required.");
        return false;
    }

    if (club === "") {
        alert("Club is required.");
        return false;
    }

    if (logoClub === 0) {
        alert("Club logo is required.");
        return false;
    }

    // rating doit être un nombre entre 1 et 99
    if (rating === "" || isNaN(rating) || rating < 1 || rating > 99) {
        alert("Rating must be a number between 1 and 99.");
        return false;
    }
    
    var ratings = [pace, dribbling, passing, shooting, defending, physical];
    var labels = ["Pace", "Dribbling", "Passing", "Shooting", "Defending", "Physical"];

    for (var i = 0; i < ratings.length; i++) {
        if (ratings[i] === "" || isNaN(ratings[i]) || ratings[i] < 1 || ratings[i] > 100) {
            alert(labels[i] + " must be a number between 1 and 100.");
            return false;
        }
    }
    return true;
}

document.querySelector("form").onsubmit = function(event) {
    if (!validateForm()) {
        event.preventDefault(); 
    }
};