const binaural = new Audio("/wav/zenmix-delta.wav");

function toogleBinaural () {
    binaural.paused ? binaural.play() : binaural.pause();
}
