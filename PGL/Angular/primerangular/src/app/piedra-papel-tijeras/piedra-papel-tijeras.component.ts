import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

@Component({
  selector: 'piedra-papel-tijeras',
  standalone: true,
  imports: [ReactiveFormsModule, FormsModule, CommonModule],
  templateUrl: './piedra-papel-tijeras.component.html',
  styleUrl: './piedra-papel-tijeras.component.css'
})
export class PiedraPapelTijerasComponent {
  opciones = ["piedra", "tijeras", "papel"];
  eleccion: String = "";
  resultado: string = "";
  finalizada: boolean = false;



  jugada() {
    let random = Math.floor(Math.random() * this.opciones.length);
    let eleccionMaquina = this.opciones[random];
    console.log(eleccionMaquina);

    console.log(this.eleccion);

    if (this.eleccion == "piedra" && eleccionMaquina == "piedra") {
      this.resultado = "empate";
    } else if (this.eleccion == "piedra" && eleccionMaquina == "papel") {
      this.resultado = "maquina";
    } else if (this.eleccion == "piedra" && eleccionMaquina == "tijeras") {
      this.resultado = "usuario";
    } else if (this.eleccion == "papel" && eleccionMaquina == "piedra") {
      this.resultado = "maquina";
    } else if (this.eleccion == "papel" && eleccionMaquina == "papel") {
      this.resultado = "empate";
    } else if (this.eleccion == "papel" && eleccionMaquina == "tijeras") {
      this.resultado = "maquina";
    } else if (this.eleccion == "tijeras" && eleccionMaquina == "piedra") {
      this.resultado = "maquina";
    } else if (this.eleccion == "tijeras" && eleccionMaquina == "papel") {
      this.resultado = "usuario";
    } else if (this.eleccion == "tijeras" && eleccionMaquina == "tijeras") {
      this.resultado = "empate";
    }

    this.finalizada = true;



  }

}
