import { Routes } from '@angular/router';

import { MostrarComponent } from './mostrar/mostrar.component';
import { CrearComponent } from './crear/crear.component';
export const routes: Routes = [
  {
    path: '',
    redirectTo: 'mostrar',
    pathMatch: 'full'
  },
  {
    path: 'mostrar',
    component: MostrarComponent,
    pathMatch: 'full'
  },
  {
    path: 'crear',
    component: CrearComponent,
    title: 'Lista'
  }
];
