import React, { useEffect, useRef, useState } from 'react'

type Props = {}

const Practica27 = (props: Props) => {
    const inputSegundos = useRef<HTMLInputElement>({} as HTMLInputElement);
    const spanSegundos = useRef<HTMLInputElement>({} as HTMLInputElement);
    const [estadoBoton, setEstadoBoton] = useState<boolean>(false);
    let valorInput = 0;
    let span = spanSegundos.current;

    useEffect(() => {
        const timerID = setInterval(cronometro, 1000);
    }, []);

    function cronometro() {
        if (estadoBoton) {
            span.innerText = ""+(parseInt(valorInput.value)-1);
            console.log(parseInt(valorInput.value)-1);
            
        }
    }

    function iniciarParar() {
        valorInput = inputSegundos.current.value;
        setEstadoBoton(!estadoBoton);

    }




    return (
        <div>
            <h3>Practica27</h3>
            <p>Cantidad segundos: <input type="number" ref={inputSegundos} /></p>
            <p><button onClick={iniciarParar}>{estadoBoton ? "Parar" : "Iniciar"}</button></p>
            <p>Quedan: <span ref={spanSegundos}></span> segundos</p>
        </div>
    )
}

export default Practica27