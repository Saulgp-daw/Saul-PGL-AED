import { StyleSheet } from "react-native";

const StylesP10 = StyleSheet.create({

    main: {
        backgroundColor: "black",
        flex: 1
    }
    ,
    estilo : {
        backgroundColor: "black",
        flex: 1
    },

    estiloBotones : {
        backgroundColor: "black",
        flex: 1.8,
        flexDirection: "row",
        flexWrap: "wrap",
        paddingHorizontal: 40

    },

    botones : {
        borderRadius: 50,
        backgroundColor: "orange",
        width: 70, // 4 columnas en una fila (100% / 4)
        height: 70, 
        alignItems: "center",
        justifyContent: "center",
        margin: 5
    },

    textoBotones : {
        color: "white",
        fontSize: 20,
        fontWeight: "bold",
        position: "absolute"

    }

});

export default StylesP10;