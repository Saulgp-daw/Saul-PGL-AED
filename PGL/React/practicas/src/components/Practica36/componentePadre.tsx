import React, { useState } from 'react'
import { Persona } from './Persona'
import style from '../CSS/ComponentePadre.module.css'
import PersonaCard from './personaCard'

type Props = {}

const ComponentePadre = (props: Props) => {
    const [arrayPersonas, setArrayPersonas] = useState<Array<Persona>>([]);

    function crearPersona() {
        setArrayPersonas([...arrayPersonas, new Persona(arrayPersonas.length)]);
    }

    function modificarPersona(personaHijo: Persona) {
       
        console.log(personaHijo);
        
        
        const personaEncontrada = arrayPersonas.find(persona => persona.getId() == personaHijo.getId());
        personaEncontrada?.setNombre(personaHijo.getNombre());
        personaEncontrada?.setApellido(personaHijo.getApellido());
        personaEncontrada?.setAltura(personaHijo.getAltura());
        personaEncontrada?.setPeso(personaHijo.getPeso());
        personaEncontrada?.calcularIMC(personaHijo.getPeso(), personaHijo.getAltura());
        console.log(personaEncontrada);
        
    }

    return (
        <div>
            <h3>Componente Padre</h3>
            <div className="container">
                {
                    arrayPersonas.map(persona => (
                        <PersonaCard modificarStatePadre={modificarPersona} persona={persona}/>
                    ))
                }
            </div>

            <button onClick={crearPersona} className={style.btnAgregarPersona}>+</button>
        </div>
    )
}

export default ComponentePadre