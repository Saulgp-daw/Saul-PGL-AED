import axios from 'axios';
import React from 'react'
import { useNavigate } from 'react-router-dom';
import { useAppContext } from '../contexts/PeliculasContextProvider';

type Props = {}

export interface iLogin {
    username: string,
    password: string
}

const Login = (props: Props) => {
    const ruta = "http://localhost:8080/api/v1/login";
    const navigate = useNavigate();
    const { token, settoken } = useAppContext();

    function login(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();
        let formulario: HTMLFormElement = event.currentTarget;
        let username: string = formulario.username.value;
        let password: string = formulario.password.value;

        const nuevoLogin: iLogin = {
            username: username,
            password: password
        }

        console.log(nuevoLogin);



        const axiospost = async () => {
            try {
                const response = await axios.post(ruta, nuevoLogin);
                console.log(response.data);
                let status = response.status;

                if (status === 200) {
                    settoken(response.data);
                    navigate("/");
                }


            } catch (error) {
                console.log(error);
            }
        }
        axiospost();

    }

    return (
        <div>
            <h3>Login</h3>
            <form onSubmit={login}>
                <label htmlFor="username">Username: </label>
                <input type="text" name='username' /><br />
                <label htmlFor="password">Contraseña: </label>
                <input type="text" name='password' /><br />
                <button type='submit'>Entrar</button>
            </form>
        </div>
    )
}

export default Login