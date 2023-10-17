import { ChangeEvent, useState } from "react"

type Producto = {
    nombre: string,
    precio: number,
    cantidad: number
}

export default function FormularioProductos(){
    const [listaProductos, setListaProductos] = useState<Array<Producto>>([]);
    const [productosFiltrados, setFiltrados] = useState<Array<Producto>>([]);

    function procesarFormulario(event: React.FormEvent<HTMLFormElement>){
        event.preventDefault();
        let formulario = event.currentTarget;
        const nombre = formulario.nombre.value ?? "";
        const precio = Number(formulario.precioid.value ?? 0);
        const cantidad = Number(formulario.cantidad.value ?? 0);
        const producto: Producto = {
            nombre: nombre,
            precio: precio,
            cantidad: cantidad
        };
        setListaProductos([...listaProductos, producto]);
    }

    function filtrarNombre(event:ChangeEvent<HTMLInputElement>){
        const nombre = event.currentTarget.value;
        const productosFiltrados = listaProductos.filter(producto => {
            return producto.nombre.toLowerCase().includes(nombre.toLowerCase());
        });
        setFiltrados(productosFiltrados);
    }
    
    return (
        <div>
            <h3>Info de Productos</h3>
            <form onSubmit={procesarFormulario}>
                <label htmlFor="nombreid">Nombre: </label>
                <input type="text" name="nombre" id="nombreid" /><br />
                <label htmlFor="precioid">Precio: </label>
                <input type="number" name="precio" id="precioid" /><br />
                <label htmlFor="cantidadid">Cantidad: </label>
                <input type="number" name="cantidad" id="cantidadid" /><br />
                <button type="submit">Agregar</button>
            </form>
            <label htmlFor="filtrar">Filtrar: </label><input type="text" onChange={filtrarNombre}/><br />
            <textarea value={JSON.stringify(listaProductos, null, 2)} cols={100} rows={30}/>
            <ul>
                {
                    productosFiltrados.map(prod => (
                        <li>{prod.nombre}</li>
                    ))
                }
            </ul>
        </div>
    )
}