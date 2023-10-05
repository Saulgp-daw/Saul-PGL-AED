import React, { useEffect, useState } from 'react'

type Props = {}

const PruebaUseEffect = (props: Props) => {
    

    const [color, setColor] = useState(0);

    useEffect(() => {
        setColor(-5);

    }, [Number(color) > 4]);

    return (
        <>
            <div>{color}</div>
            <button onClick={() => setColor(color+1)}>Cambiar</button>
        </>
        
    )
}

export default PruebaUseEffect