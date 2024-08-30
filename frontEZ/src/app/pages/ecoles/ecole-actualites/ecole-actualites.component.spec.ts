import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EcoleActualitesComponent } from './ecole-actualites.component';

describe('EcoleActualitesComponent', () => {
  let component: EcoleActualitesComponent;
  let fixture: ComponentFixture<EcoleActualitesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [EcoleActualitesComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(EcoleActualitesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
