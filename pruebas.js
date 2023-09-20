let nuevoSet = new Set();
nuevoSet.add("hola");
nuevoSet.add(1);
nuevoSet.add("Adios");
nuevoSet.add("hola");

nuevoSet.forEach(element => {
    console.log(element);
});