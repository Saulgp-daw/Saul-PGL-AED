import React, { useEffect, useState } from 'react'
type Props = {}
const Practica19 = (props: Props) => {
    const [contador, setcontador] = useState<number>(100);
    useEffect(() => {
        const efecto = () =>{
        let fecha = new Date();
        console.log(fecha);
        setcontador(-1);
        }
        efecto();
       }, [contador>10] )
    return (
        <div>
            <h3>info en state: {contador}</h3>
            <button onClick={() => setcontador(contador + 1)}>Actualizar state</button>
        </div>
    )
}
export default Practica19
