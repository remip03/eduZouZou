import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ModifierMdpComponent } from './modifier-mdp.component';

describe('ModifierMdpComponent', () => {
  let component: ModifierMdpComponent;
  let fixture: ComponentFixture<ModifierMdpComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ModifierMdpComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ModifierMdpComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
