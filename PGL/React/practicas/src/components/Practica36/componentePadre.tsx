import React, { useEffect, useState } from 'react';
import { Persona } from './Persona';
import style from '../CSS/ComponentePadre.module.css';
import PersonaCard from './personaCard';
import axios from 'axios';

type Props = {}

interface iPersonas {
    personas: Array<Persona>
}


function ComponentePadre(props: Props) {
    const [arrayPersonas, setArrayPersonas] = useState<iPersonas>({ personas: [] });
    const uri: string = "http://localhost:3000/personas/";

    useEffect(() => {
        async function recogerDatosPersonas(ruta: string) {
            const response = await axios.get(ruta);
            console.log(response.data);

            const personasGuardadas: iPersonas = {
                personas: response.data
            }

            setArrayPersonas(personasGuardadas);

        }
        recogerDatosPersonas(uri);
    }, [])

    async function fichaNuevaPersona() {
        if(arrayPersonas.personas.length > 0){
            const ultimoId: number = arrayPersonas.personas[arrayPersonas.personas.length-1].id;
            const nuevaPersonaLocal = new Persona(ultimoId+1);
            setArrayPersonas({ personas: [...arrayPersonas.personas, nuevaPersonaLocal] });
        }else{
            const nuevaPersonaLocal = new Persona(arrayPersonas.personas.length+1);
            setArrayPersonas({ personas: [...arrayPersonas.personas, nuevaPersonaLocal] });
        }

       

        
    }

    function modificarPersona(personaHijo: Persona) {
        console.log(personaHijo);
        let arrayFiltrado = arrayPersonas.personas.filter(p => p.id !== personaHijo.getId());
        arrayFiltrado.push(personaHijo);
        arrayFiltrado.sort((a, b) => a.id - b.id);
        setArrayPersonas({ personas: arrayFiltrado });
    }

    return (
        <div>
            <h3>Componente Padre</h3>
            <div className="contenedorPersona">
                {arrayPersonas.personas.map((persona: Persona) => {
                    const unaPersona = new Persona(persona.id, persona.nombre, persona.apellido, persona.altura, persona.edad, persona.peso, persona.imc);
                    return (
                        <div className={style.personaCard} key={unaPersona.getId()}>
                            <PersonaCard modificarStatePadre={modificarPersona} persona={unaPersona} ultimoId={arrayPersonas.personas[arrayPersonas.personas.length-1].id} />
                        </div>
                    )
                })}
            </div>

            <button onClick={fichaNuevaPersona} className={style.btnAgregarPersona}>Agregar</button>
        </div>
    )
}

export default ComponentePadre;