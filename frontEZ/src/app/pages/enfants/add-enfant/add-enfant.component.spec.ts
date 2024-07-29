import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AddEnfantComponent } from './add-enfant.component';

describe('AddEnfantComponent', () => {
  let component: AddEnfantComponent;
  let fixture: ComponentFixture<AddEnfantComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [AddEnfantComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(AddEnfantComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
