import React, { useState } from 'react'

type Props = {}

const Practica20 = (props: Props) => {
    const [texto, setTexto]  = useState("");
    
    const nuevoAleatorio = Math.floor(Math.random()*10);
    const [aleatorio, setAleatorio] = useState(nuevoAleatorio);

    function apostar(num: number){
      if(num > aleatorio){
        setTexto(texto +", "+ num+"> aleatorio");
      }else if(num < aleatorio){
        setTexto(texto +", "+num+"< aleatorio");
      }else{
        setTexto("Acertaste, el aleatorio se cambiará");
        setAleatorio(nuevoAleatorio);
      }
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
        <p>{texto}</p>
    </div>
  )
}

export default Practica20