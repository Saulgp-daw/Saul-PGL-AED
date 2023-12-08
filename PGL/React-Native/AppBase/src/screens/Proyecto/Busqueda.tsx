import { ScrollView, StyleSheet, Text, TouchableOpacity, View } from 'react-native'
import React from 'react'
import Navbar from '../../components/Proyecto/Navbar'
import Slider from '../../components/Proyecto/Slider'
import Piso from '../../navigators/Proyecto/Piso'

type Props = {
  navigation: any,
}

const Busqueda = ({ navigation }: Props) => {
  return (
    <View style={{ flex: 1 }}>
      <Navbar />
      <ScrollView style={styles.busqueda}>
        <TouchableOpacity onPress={() => navigation.navigate('Piso')} >
          <View style={styles.caja} >
            <Slider images={[
              { id: 1, source: require('../../resources/Proyecto/piso1.jpg') },
              { id: 2, source: require('../../resources/Proyecto/piso1-2.jpg') },
              { id: 3, source: require('../../resources/Proyecto/piso1-3.jpg') },
              // Agrega más imágenes según sea necesario
            ]} />

            <View style={styles.datosContainer}>
              <Text style={styles.infoRelevante} >Titulo</Text>
              <Text style={styles.infoRelevante}>Precio €</Text>
            </View>
            <View style={styles.datosContainer}>
              <Text>Nº Hab</Text>
              <Text>Nº inquilinos</Text>
              <Text>Propietario</Text>
            </View>
          </View>
        </TouchableOpacity>
        <TouchableOpacity onPress={() => navigation.navigate('Piso')} >
          <View style={styles.caja} >
            <Slider images={[
              { id: 1, source: require('../../resources/Proyecto/piso2.jpg') },
              { id: 2, source: require('../../resources/Proyecto/piso2-2.jpg') },
              { id: 3, source: require('../../resources/Proyecto/piso2-3.jpg') },
              // Agrega más imágenes según sea necesario
            ]} />
            <View style={styles.datosContainer}>
              <Text style={styles.infoRelevante} >Titulo</Text>
              <Text style={styles.infoRelevante}>Precio €</Text>
            </View>
            <View style={styles.datosContainer}>
              <Text>Nº Hab</Text>
              <Text>Nº inquilinos</Text>
              <Text>Propietario</Text>
            </View>
          </View>
        </TouchableOpacity>
      </ScrollView>
    </View>


  )
}

export default Busqueda

const styles = StyleSheet.create({
  busqueda: {
    display: 'flex',
    alignContent: 'center'
  },

  caja: {
    margin: 10,
    paddingHorizontal: 30,
    paddingVertical: 10,
    borderColor: "#2bfc23",
    borderWidth: 2,
    borderRadius: 5,
  },
  datosContainer: {
    marginTop: 10,
    display: 'flex',
    flexDirection: 'row',
    justifyContent: 'space-between'
  },

  infoRelevante: {
    fontWeight: 'bold',
    fontSize: 20
  }

})