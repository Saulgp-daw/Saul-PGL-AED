import React from 'react'
import Tabla from './Tabla';

const TodasLasTablas = () => {
    let array: Array<number> = [2, 3, 4, 5, 6, 7, 8, 9, 10];

    return (
        <div className='grid'>
           {
                array.map((elemento, index) => {
                    return <Tabla numero={elemento}/>
                })
           }
        </div>

    )
}

export default TodasLasTablas;


