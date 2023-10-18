import React, { useState } from 'react'


const usePractica33 = () => {
    const [numerosPrimos, setNumerosPrimos] = useState<Array<number>>([]);
  
    function mostrarPrimos(event: React.FormEvent<HTMLFormElement>){
      event.preventDefault();
      let formulario = event.currentTarget;
      const menor = Number(formulario.menor.value) ?? 0;
      const mayor = Number(formulario.mayor.value) ?? 100;
  
      let primos: number[] = [];
  
      for (let i = menor; i <= mayor; i++) {
        let esPrimo = true;
  
        if (i > 1) {
          for (let j = 2; j <= Math.sqrt(i); j++) {
            if (i % j === 0) {
              esPrimo = false;
              break;
            }
          }
          if (esPrimo) {
            primos.push(i);
          }
        }
      }
  
      setNumerosPrimos(primos);
    }

    return {
        "mostrarPrimos" : mostrarPrimos,
        "numerosPrimos" : numerosPrimos
    }
}

export default usePractica33;