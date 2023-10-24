const canvas = document.querySelector('canvas');
const audio = document.querySelector('audio');
audio.volume = 0.2;
const ctx = canvas.getContext('2d');
canvas.width = innerWidth;
canvas.height = 300;
ctx.fillRect(0, 0, canvas.width, canvas.height);


const initAnalyser = async (audio) => {
    const context = new AudioContext();
    const src = context.createMediaElementSource(audio);
    const analyser = context.createAnalyser();
    src.connect(analyser);
    analyser.connect(context.destination);
    analyser.fftSize = 256;
    return analyser;
}

function drawAudio(analyser){
    const WIDTH = canvas.width;
    const HEIGHT = canvas.height;
    requestAnimationFrame( () => drawAudio(analyser));
    const bufferLength = analyser.frequencyBinCount;
    const dataArray = new Uint8Array(bufferLength);
    const barWidth = (WIDTH / bufferLength) * 3;
    let x = 0;
    analyser.getByteFrequencyData(dataArray);
    ctx.fillStyle = '#111111';
    ctx.fillRect(0, 0, WIDTH, HEIGHT);

    dataArray.forEach((decibel, index) => {
        const c = index / bufferLength;
        const r = decibel + 70 * c;
        const g = 250 * c;
        const b = 250;
        ctx.fillStyle = `rgb(${r}, ${g}, ${b})`;
        ctx.fillRect(x, (HEIGHT-decibel), barWidth, decibel);
        x += barWidth + 1;
    });

}


async function  inicializar(){
    const analyser = await initAnalyser(audio);
    audio.play();
    drawAudio(analyser);
    
}

inicializar();