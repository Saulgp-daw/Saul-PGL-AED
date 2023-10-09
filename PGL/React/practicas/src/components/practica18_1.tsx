import React, { useState, useEffect } from 'react';
function Practica18_useEffect() {
    const [count, setCount] = useState(0);
    // De forma similar a componentDidMount y componentDidUpdate
    // Actualiza el título del documento usando
    //la API del navegador
    useEffect(() => { document.title = `You clicked ${count} times`; });
    return (
        <div>
            <p>You clicked {count} times</p>
            <button onClick={() => setCount(count + 1)}>
                Click me
            </button>
        </div>
    );
}

export default Practica18_useEffect;
