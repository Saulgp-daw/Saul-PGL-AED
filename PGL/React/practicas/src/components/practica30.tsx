import React, { ChangeEvent, useRef, useState } from 'react'

type Props = {}

const Practica30 = (props: Props) => {
    const [texto, setTexto]  = useState("");
    const numInput = useRef<HTMLInputElement>({} as HTMLInputElement);
    
    const nuevoAleatorio = Math.floor(Math.random()*10);
    const [aleatorio, setAleatorio] = useState(nuevoAleatorio);
    const [ganar, setGanar] = useState(false);
    const [numApuesta, setNumApuesta] = useState(0);

    function apostar(){
      //let num:number = parseInt(numInput.current.value);
      //numInput.current.value = "";
      if(numApuesta > aleatorio){
        setTexto(texto +", "+ numApuesta+"> aleatorio");
      }else if(numApuesta < aleatorio){
        setTexto(texto +", "+numApuesta+"< aleatorio");
      }else{
        setTexto("Acertaste, el aleatorio se cambiará");
        setGanar(true);
      }
    }

    function reiniciar(){
      setTexto("");
      setGanar(false);
      setAleatorio(nuevoAleatorio);
    }

    function handleChange(event:ChangeEvent<HTMLInputElement>){
      setNumApuesta(parseInt(event.currentTarget.value));
    }


    const numeros: Array<number> = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];


  return (
    <div>
      <h3>Acertar número</h3>
        <label htmlFor="Apuesta">Apuesta: </label><input type="number" onChange={handleChange} />
        <button onClick={apostar}>Apostar</button>
        <p>{(ganar)? <button onClick={reiniciar}>Reiniciar</button> : ""}</p>
        <p>{texto}</p>

    </div>
  )
}

export default Practica30