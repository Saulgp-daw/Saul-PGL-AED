import { StyleSheet } from "react-native";

const stylesp08 = StyleSheet.create({
    principal : {
        backgroundColor: "lightblue",
        flex: 1
    },

    practica09 : {
        backgroundColor: "#c5cbd4",
        flex: 1,
        paddingHorizontal: 40
    },

    contenedor : {
        backgroundColor: "grey",
        flexDirection: "row",
        //flexWrap: "wrap",
        flex: 1,
        height: 1000,
        borderColor: "yellow",
        borderWidth: 2,
        padding: 5
    },
    imagenes : {
        backgroundColor: "grey",
        //flexDirection: "row",
        //flexWrap: "wrap",
        alignItems: "flex-end",
        justifyContent: "space-around",
        flex: 1,
        height: 1000,
        borderColor: "yellow",
        borderWidth: 2,
        padding: 5
    },
    botones : {
        flexWrap: "wrap",
        flexDirection: "row",
        justifyContent: "space-between"
    },

    input : {
        backgroundColor: "white"
    }
});

export default stylesp08;