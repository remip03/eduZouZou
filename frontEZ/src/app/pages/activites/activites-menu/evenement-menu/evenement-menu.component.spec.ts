import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EvenementMenuComponent } from './evenement-menu.component';

describe('EvenementMenuComponent', () => {
  let component: EvenementMenuComponent;
  let fixture: ComponentFixture<EvenementMenuComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [EvenementMenuComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(EvenementMenuComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
