window.onload = setInitialVolume();
window.onload = setAudioTime();

function toggleMusicOptions(){
    var element = document.getElementById("musicController");
    element.classList.toggle("show");
}

function setInitialVolume(){
    var music = document.getElementById("music");
    
    if(sessionStorage.getItem('volume')!=null){
        music.volume = sessionStorage.getItem('volume');
    }
    else{
        music.volume = 0.5;
    
        sessionStorage.setItem('volume', 0.5);
    }
}

function setVolume(vol){
    var music = document.getElementById("music");
    
    music.volume = vol;

    sessionStorage.setItem('volume', vol);
}


function saveAudioTime(){
    var music = document.getElementById("music");
    
    sessionStorage.setItem('timestamp', music.currentTime);
}

function setAudioTime(){
    var music = document.getElementById("music");
    
    if(sessionStorage.getItem('timestamp')!=null){
        music.currentTime = sessionStorage.getItem('timestamp');
    }
    else{
        music.currentTime = 0;
    }
    console.log(sessionStorage.getItem('timestamp'));
}



function showTutorial(){
    var video = document.getElementById("videoContainer");
    
    if(video.style.display != 'block'){
        video.style.display = 'block';
    }
    else{
        video.style.display = 'none';
    } 
}
