import React from 'react'
import style from '../CSS/ComponenteB.module.css'

type Props = {}

interface PropsAHijos {
    modificarStatePadre: Function;
}


const ComponenteB = (props: PropsAHijos) => {

    function enviarInfo(){
        const {modificarStatePadre} = props;
        modificarStatePadre("pulsado botón en B");
    }


  return (
    <div className={style.componenteB}>
        <h3>Componente Hijo B</h3>
        <button onClick={enviarInfo}>Avisa padre desde B</button>
    </div>
  )
}

export default ComponenteB