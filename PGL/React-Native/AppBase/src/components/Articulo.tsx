import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { RouteProp } from '@react-navigation/native';
import WebView from 'react-native-webview';

type RootStackParamList = {
    element: { articulo: any }
}

type ScreenRouteProp = RouteProp<RootStackParamList, "element">;

type Props = {
    navigation?: any;
    route?: ScreenRouteProp
}

const Articulo = ({ navigation, route }: Props) => {
    const articulo = route?.params.articulo;
    console.log(articulo);


    const generateHTML = () => {
        if (articulo) {

            const htmlContent = `<html>
            <body>
              ${articulo}
            </body>
          </html>`;

            return htmlContent;

        } else {
            return ''; // O algún otro contenido por defecto si 'articulos' no está disponible
        }
    };

    return (
        <WebView
            source={{
                html: generateHTML(),
            }}
            style={{ width: '100%', maxHeight: '100%' }}
        />
    )
}

export default Articulo

const styles = StyleSheet.create({})