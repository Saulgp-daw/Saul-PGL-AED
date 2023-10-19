import React, { useState } from 'react'
import ComponenteA from './componenteA';
import ComponenteB from './componenteB';


type Props = {}

const EjStateByProps = () => {
    const [mensajeHijos, setMensajeHijos] = useState<string>("");

    function modificarPadre(dato: string) {
        setMensajeHijos(dato);
    }

    return (
        <div>
            <h3>EjStateByProps.</h3>
            <h5>Mensaje recibido: {mensajeHijos}</h5>
            <ComponenteA modificarStatePadre={modificarPadre}/>
            <ComponenteB modificarStatePadre={modificarPadre} />
        </div>
    )
}

export default EjStateByProps