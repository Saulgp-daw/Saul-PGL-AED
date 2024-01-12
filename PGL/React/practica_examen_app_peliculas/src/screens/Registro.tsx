import axios from 'axios';
import React from 'react'
import { useNavigate } from 'react-router-dom';

type Props = {}

export interface iRegistro {
    username: string,
    password: string,
    email: string
}

const Registro = (props: Props) => {
    const ruta = "http://localhost:8080/api/v1/register";
    const navigate = useNavigate();

    function registro(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();
        let formulario: HTMLFormElement = event.currentTarget;
        let username: string = formulario.username.value;
        let password: string = formulario.password.value;
        let email: string = formulario.email.value;

        const nuevoRegistro: iRegistro = {
            username: username,
            password: password,
            email: email
        }

        console.log(nuevoRegistro);

        const axiospost = async () => {
            try {
                const response = await axios.post(ruta, nuevoRegistro);
                console.log(response.data);
                navigate("/login");
            } catch (error) {
                console.log(error);
            }
        }
        axiospost();

    }

    return (
        <div>
            <h3>Registro</h3>
            <form onSubmit={registro}>
                <label htmlFor="username">Username: </label>
                <input type="text" name='username' /><br />
                <label htmlFor="password">Contraseña: </label>
                <input type="text" name='password' /><br />
                <label htmlFor="email">Email: </label>
                <input type="text" name='email' /><br />
                <button type='submit'>Registrarse</button>
            </form>
        </div>
    )
}

export default Registro