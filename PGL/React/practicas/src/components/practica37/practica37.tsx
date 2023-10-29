
import React, { useState } from 'react'
import ReactPlayer from 'react-player'
import p5 from '../../assets/audio/2-23. The Days When My Mother Was There.mp3';
import xc3 from '../../assets/audio/200. Elysium in the Dream.mp3';

type Props = {}

const Practica37 = (props: Props) => {

    const [cancion, setCancion] = useState(p5);

    function cambiarCancion(song: string) {
        switch (song) {
            case "p5":
                setCancion(p5);
                break;

            case "xc3":
                setCancion(xc3);
                break;

            default:
                break;
        }
    }

    console.log(process.env.PUBLIC_URL);
    return (
        <div>
            <ReactPlayer
                url={cancion}
                controls
                width="400px"
                height="20px"
                preload="none"
            />

            <button onClick={() => cambiarCancion("p5")}>The days My mother was there</button>
            <button onClick={() => cambiarCancion("xc3")}>Elysium in the dream</button>



        </div>
    )
}

export default Practica37