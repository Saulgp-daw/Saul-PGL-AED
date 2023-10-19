import React, { ChangeEvent, useState } from 'react'
import style from '../CSS/ComponenteA.module.css'

type Props = {}

interface PropsAHijos {
    modificarStatePadre: Function;
}

function ComponenteA(props: PropsAHijos) {
    const [mensaje, setMensaje] = useState<string>("");

    function enviarInfo(e: ChangeEvent<HTMLInputElement>){
        const {modificarStatePadre} = props;
        modificarStatePadre("input A dice: "+e.currentTarget.value);
    }
  return (
    <div className={style.componentA}>
        <h3>Componente Hijo A</h3>
        <input type="text" onChange={enviarInfo}/>
    </div>
  )
}

export default ComponenteA