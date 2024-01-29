import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PiedraPapelTijerasComponent } from './piedra-papel-tijeras.component';

describe('PiedraPapelTijerasComponent', () => {
  let component: PiedraPapelTijerasComponent;
  let fixture: ComponentFixture<PiedraPapelTijerasComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [PiedraPapelTijerasComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(PiedraPapelTijerasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
