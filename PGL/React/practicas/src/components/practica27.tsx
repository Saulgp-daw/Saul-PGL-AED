import React, { useEffect, useRef, useState } from 'react'

type Props = {}
type Timer = "iniciar" | "parar";
type NumeroRef = {
    contador: number
}

const Practica27 = (props: Props) => {
    const inputSegundos = useRef<HTMLInputElement>({} as HTMLInputElement);
    const spanSegundos = useRef<HTMLInputElement>({} as HTMLInputElement);
    const [estadoBoton, setEstadoBoton] = useState<Timer>("parar");
    const [contador, setStateContador] = useState<number>(0);
    const refTimer = useRef<ReturnType<typeof setInterval>>();
    const numeroRef = useRef({contador: 200} as NumeroRef);
    const [iniciarParar, setIniciarParar] = useState<boolean>(false);

    function tick() {
        console.log("Yepa");
        numeroRef.current.contador--;
        if(numeroRef.current.contador == 0){
            clearInterval(refTimer.current);
            alert("Fin del contador");
        }else{
            setStateContador(numeroRef.current.contador);
        }
        setStateContador(numeroRef.current.contador);
       
    }

    function iniciar(){
        
        if(!iniciarParar){
            const contadorParaAlcanzar = Number(inputSegundos.current.value);
            numeroRef.current.contador = contadorParaAlcanzar;
            
            refTimer.current = setInterval(tick, 1000);
        }else{
            inputSegundos.current.value = ""+numeroRef.current.contador;
            clearInterval(refTimer.current);
        }
        setIniciarParar(!iniciarParar);
       
    }

    
    return (
        <div>
            <h3>Practica27</h3>
            <p>Cantidad segundos: <input type="number" ref={inputSegundos} /></p>
            <p><button onClick={iniciar}>{iniciarParar ? "Parar" : "Iniciar"}</button></p>
            <p>Quedan: <span ref={spanSegundos}>{contador}</span> segundos</p>
        </div>
    )
}

export default Practica27