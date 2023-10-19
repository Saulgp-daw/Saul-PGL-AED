import React, { useState } from 'react'

type Props = {}

const Practica34 = (props: Props) => {
    const [edadPerro, setEdadPerro] = useState<number>(0);

    function mostrarEdad(event: React.FormEvent<HTMLFormElement>) {
        event.preventDefault();
        let formulario = event.currentTarget;
        const edad = Number(formulario.edad.value ?? 0);
        const tamanho = formulario.tamanho.value;
        let edadPerruna = 0;
        if (tamanho == "Pequeño") {
            switch (edad) {
                case 0.5: edadPerruna = 15;
                    break;
                case 1: edadPerruna = 20;
                    break;
                case 2: edadPerruna = 28;
                    break;
                case 3: edadPerruna = 32;
                    break;
                case 4: edadPerruna = 36;
                    break;
                case 5: edadPerruna = 40;
                    break;
                case 6: edadPerruna = 44;
                    break;
                case 7: edadPerruna = 48;
                    break;
                case 8: edadPerruna = 52;
                    break;
                case 9: edadPerruna = 56;
                    break;
                case 10: edadPerruna = 60;
                    break;
                case 11: edadPerruna = 64;
                    break;
                case 12: edadPerruna = 68;
                    break;
                case 13: edadPerruna = 72;
                    break;
                case 14: edadPerruna = 76;
                    break;
                case 15: edadPerruna = 80;
                    break;
                case 16: edadPerruna = 84;
                    break;
                default:
            }
        } else if (tamanho == "Mediano") {
            switch (edad) {
                case 0.5: edadPerruna = 10;
                    break;
                case 1: edadPerruna = 18;
                    break;
                case 2: edadPerruna = 27;
                    break;
                case 3: edadPerruna = 33;
                    break;
                case 4: edadPerruna = 39;
                    break;
                case 5: edadPerruna = 45;
                    break;
                case 6: edadPerruna = 51;
                    break;
                case 7: edadPerruna = 57;
                    break;
                case 8: edadPerruna = 63;
                    break;
                case 9: edadPerruna = 69;
                    break;
                case 10: edadPerruna = 75;
                    break;
                case 11: edadPerruna = 80;
                    break;
                case 12: edadPerruna = 85;
                    break;
                case 13: edadPerruna = 90;
                    break;
                case 14: edadPerruna = 96;
                    break;
                case 15: edadPerruna = 102;
                    break;
                case 16: edadPerruna = 110;
                    break;
                default:
            }
        }else if (tamanho == "Grande") {
            switch (edad) {
                case 0.5: edadPerruna = 8;
                    break;
                case 1: edadPerruna = 16;
                    break;
                case 2: edadPerruna = 22;
                    break;
                case 3: edadPerruna = 31;
                    break;
                case 4: edadPerruna = 40;
                    break;
                case 5: edadPerruna = 49;
                    break;
                case 6: edadPerruna = 58;
                    break;
                case 7: edadPerruna = 67;
                    break;
                case 8: edadPerruna = 76;
                    break;
                case 9: edadPerruna = 85;
                    break;
                case 10: edadPerruna = 96;
                    break;
                case 11: edadPerruna = 105;
                    break;
                case 12: edadPerruna = 112;
                    break;
                case 13: edadPerruna = 120;
                    break;
                default:
            }
        }

        setEdadPerro(edadPerruna);

    }


    return (
        <div>
            <h3>Practica 34</h3>
            <form onSubmit={mostrarEdad}>
                <label htmlFor="edad">Edad del perro: </label>
                <input type="number" name="edad" /><br />
                <input type="radio" name="tamanho" id="tamanho" value={"Pequeño"} checked /> Pequeño
                <input type="radio" name="tamanho" id="tamanho" value={"Mediano"} /> Mediano
                <input type="radio" name="tamanho" id="tamanho" value={"Grande"} /> Grande <br />
                <button type='submit'>Enviar</button>
            </form>
            <p>La edad de su perro es: {edadPerro}</p>
        </div>
    )
}

export default Practica34