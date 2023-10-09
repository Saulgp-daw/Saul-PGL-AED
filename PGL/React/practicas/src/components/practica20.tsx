import React, { useState } from 'react'

type Props = {}

const Practica20 = (props: Props) => {
    const [texto, setTexto]  = useState("");
    
    const nuevoAleatorio = Math.floor(Math.random()*10);
    const [aleatorio, setAleatorio] = useState(nuevoAleatorio);
    const [ganar, setGanar] = useState(false);

    function apostar(num: number){
      if(num > aleatorio){
        setTexto(texto +", "+ num+"> aleatorio");
      }else if(num < aleatorio){
        setTexto(texto +", "+num+"< aleatorio");
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


    const numeros: Array<number> = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];


  return (
    <div>
      <h3>Acertar número</h3>
        {
            numeros.map((numero, index) => {
                return <button onClick={()=>apostar(numero)} > {numero} </button>
            })
            
        }
        <p>{(ganar)? <button onClick={reiniciar}>Reiniciar</button> : ""}</p>
        <p>{texto}</p>

    </div>
  )
}

export default Practica20