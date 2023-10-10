import React, { useEffect, useState } from 'react'

type Props = {}

const NumerosAleatorios = () => {
const [numerosAleatorios, setNumerosAleatorios] = useState<number[]>([]);

useEffect(() => {
  const generarNumerosAleatorios = () => {
    const nuevosNumeros = [];
    for (let i = 0; i < 10; i++) {
      const numeroAleatorio = Math.floor(Math.random() * 100) + 1; // Números aleatorios del 1 al 100
      nuevosNumeros.push(numeroAleatorio);
    }
    setNumerosAleatorios(nuevosNumeros);
  };

  generarNumerosAleatorios();
}, []); // El array vacío asegura que este efecto se ejecute solo una vez, después del montaje inicial del componente

return (
  <div>
    <h1>Números Aleatorios:</h1>
    <ul>
      {numerosAleatorios.map((numero, index) => (
        <li key={index}>{numero}</li>
      ))}
    </ul>
  </div>
);
}
export default NumerosAleatorios