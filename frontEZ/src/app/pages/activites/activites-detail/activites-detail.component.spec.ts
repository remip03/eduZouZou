import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ActivitesDetailComponent } from './activites-detail.component';

describe('ActivitesDetailComponent', () => {
  let component: ActivitesDetailComponent;
  let fixture: ComponentFixture<ActivitesDetailComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ActivitesDetailComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ActivitesDetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
