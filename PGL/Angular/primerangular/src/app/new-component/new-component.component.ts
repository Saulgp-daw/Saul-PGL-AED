import { Component, Input } from '@angular/core';

@Component({
  selector: 'app-new-component',
  standalone: true,
  imports: [],
  templateUrl: './new-component.component.html',
  styleUrl: './new-component.component.css'
})
export class NewComponentComponent {
  @Input() tabla = 1;

  multiplicador: number = 1;

  get resultado(): number {
    return this.tabla * this.multiplicador;
  }

  incrementar() {
    this.multiplicador += 1;
    if (this.multiplicador > 10) {
      this.multiplicador = 1;
    }
  }
}
