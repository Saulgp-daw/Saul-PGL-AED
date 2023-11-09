import React from 'react'
import { Persona } from './Persona'
import style from '../CSS/PersonaCard.module.css'
import axios from 'axios'

type Props = {}

interface PropsAHijos {
    modificarStatePadre: Function,
    persona: Persona,
    ultimoId: number
}

function PersonaCard(props: PropsAHijos) {
    const { persona, modificarStatePadre } = props;
    console.log(props.ultimoId);
    

    function enviarInfo(e: React.ChangeEvent<HTMLInputElement>) {
        const { name, value } = e.currentTarget;
        console.log(name + " " + value);



        // Actualizar el valor correspondiente en el objeto persona
        const nuevaPersona = {
            ...persona,
            [name]: name === "altura" || name === "edad" || name === "peso" ? Number(value) : value
        } as Persona;


        let personaCambiada = new Persona(nuevaPersona.id,
            nuevaPersona.nombre,
            nuevaPersona.apellido,
            nuevaPersona.altura,
            nuevaPersona.edad,
            nuevaPersona.peso);

        personaCambiada.calcularIMC();
        //setPersonaState(personaCambiada)
        modificarStatePadre(personaCambiada);


        //console.log(personaCambiada);

        // Llamar a la función del padre con la nueva persona
        //modificarStatePadre(nuevaPersona);
    }

    function agregarPersona(event: React.FormEvent<HTMLFormElement>) {
        console.log(persona);

        event.preventDefault();
        let formulario: HTMLFormElement = event.currentTarget;
        let nombre: string = formulario.nombre.value;
        let apellido: string = formulario.apellido.value;
        let altura: number = parseFloat(formulario.altura.value);
        let edad: number = parseInt(formulario.edad.value);
        let peso: number = parseInt(formulario.peso.value);

        const nuevaPersona = {
            "id": persona.getId(),
            "nombre": nombre,
            "apellido": apellido,
            "altura": altura,
            "edad": edad,
            "peso": peso,
            "IMC": persona.getImc()
        }

        let ruta = "http://localhost:3000/personas";
        const axiospost = async (ruta: string) => {
            try {
                const response = await axios.post(ruta, nuevaPersona)
                console.log(response.data);
            } catch (error) {
                console.log(error);
            }
        }
        axiospost(ruta);

    }

    return (
        <div>
            <form onSubmit={agregarPersona}>
                <h4>Id: {persona.getId()}</h4>
                <label htmlFor="nombre">Nombre: </label><input type="text" name="nombre" defaultValue={persona.getNombre()} onChange={enviarInfo} /><br />
                <label htmlFor="apellido">Apellido: </label><input type="text" name="apellido" defaultValue={persona.getApellido()} onChange={enviarInfo} /><br />
                <label htmlFor="altura">Altura: </label><input type="number" name="altura" defaultValue={persona.getAltura()} onChange={enviarInfo} /><br />
                <label htmlFor="edad">Edad: </label><input type="number" name="edad" defaultValue={persona.getEdad()} onChange={enviarInfo} /><br />
                <label htmlFor="peso">Peso: </label><input type="number" name="peso" defaultValue={persona.getPeso()} onChange={enviarInfo} />
                <p>IMC: {persona.getImc()} </p>
                {persona.getId() < props.ultimoId ? (
                    // Código a mostrar si el nombre no está vacío
                    <div>
                        <button type="submit">Borrar </button>
                    </div>
                ) : (
                    // Código a mostrar si el nombre está vacío
                    <button type="submit">Crear </button>
                )}

            </form>

        </div >
    )
}

export default PersonaCard