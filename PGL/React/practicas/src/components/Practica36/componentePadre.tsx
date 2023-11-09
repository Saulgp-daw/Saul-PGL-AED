import React, { useState } from 'react'
import { Persona } from './Persona'
import style from '../CSS/ComponentePadre.module.css'
import PersonaCard from './personaCard';

type Props = {}

function ComponentePadre (props: Props) {
    const [arrayPersonas, setArrayPersonas] = useState<Array<Persona>>([]);

    function crearPersona() {
        setArrayPersonas([...arrayPersonas, new Persona(arrayPersonas.length)]);
    }

    function modificarPersona(personaHijo: Persona) {
        console.log(personaHijo);
        //const personaEncontrada = arrayPersonas.find(persona => persona.getId() == personaHijo.getId());
        let arrayFiltrado = arrayPersonas.filter(p => p.id != personaHijo.id);
        arrayFiltrado.push(personaHijo)
        arrayFiltrado.sort((a, b) => a.id - b.id)
        setArrayPersonas(arrayFiltrado);
        
    }

    return (
        <div>
            <h3>Componente Padre</h3>
            <div className="contenedorPersona">
                {
                    arrayPersonas.map(persona => (
                        <div className={style.personaCard} key={persona.getId()}>
                            <PersonaCard modificarStatePadre={modificarPersona} persona={persona}/>
                        </div>
                    ))
                }
            </div>

            <button onClick={crearPersona} className={style.btnAgregarPersona}>Agregar</button>
        </div>
    )
}

export default ComponentePadre