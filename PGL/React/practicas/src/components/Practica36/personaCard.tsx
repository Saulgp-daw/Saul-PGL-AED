import React from 'react'
import { Persona } from './Persona'
import style from '../CSS/PersonaCard.module.css'

type Props = {}

interface PropsAHijos {
    modificarStatePadre: Function,
    persona: Persona
}

function PersonaCard (props: PropsAHijos) {
    const { persona, modificarStatePadre } = props;

    function enviarInfo(e: React.ChangeEvent<HTMLInputElement>) {
        const { name, value } = e.currentTarget;
        console.log(name+ " "+value);

        
         
        // Actualizar el valor correspondiente en el objeto persona
        const nuevaPersona = {
            ...persona,
            [name]: value
        };

        /**
         * let personaCambiad = new Persona(nuevaPersona.id,
         * nuevaPersona.nombre, 
         * nuevaPersona.apellido, 
         * nuevaPersona.altura, 
         * nuevaPersona.edad, 
         * nuevaPersona.peso);
         * 
         * personaCambiada.calcularImc()
         * setPersonaState(personaCambiada)
         * modificarStatePadre(personaCambiada);
         */

        console.log(nuevaPersona);
        
        // Llamar a la función del padre con la nueva persona
        modificarStatePadre(nuevaPersona);
    }
    return (
        <div>
            <h4>Id: {persona.getId()}</h4>
            <label htmlFor="nombre">Nombre: </label><input type="text" name="nombre" defaultValue={persona.getNombre()} onChange={enviarInfo} /><br />
            <label htmlFor="apellido">Apellido: </label><input type="text" name="apellido" defaultValue={persona.getApellido()} onChange={enviarInfo} /><br />
            <label htmlFor="altura">Altura: </label><input type="number" name="altura" defaultValue={persona.getAltura()} /><br />
            <label htmlFor="edad">Edad: </label><input type="number" name="edad" defaultValue={persona.getEdad()} /><br />
            <label htmlFor="peso">Peso: </label><input type="number" name="peso" defaultValue={persona.getPeso()} />
            <p>IMC: {persona.getImc()} </p>

        </div >
    )
}

export default PersonaCard