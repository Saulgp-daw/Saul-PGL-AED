
import React, { useState } from 'react'
import ReactPlayer from 'react-player'
import musiq from '../../assets/audio/2-23. The Days When My Mother Was There.mp3';

type Props = {}

const Practica37 = (props: Props) => {
    
    const [playlist, setPlaylist] = useState([
        
    ])
    
    console.log(process.env.PUBLIC_URL);
    return (
        <div>
            <ReactPlayer
                url={musiq}
                controls
                width="400px"
                height="20px"
                preload="none"
            />
           
            

        </div>
    )
}

export default Practica37