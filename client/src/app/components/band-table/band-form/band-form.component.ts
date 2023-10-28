import {Component, Inject, OnInit} from '@angular/core';
import {Band} from "../../../../interfaces/band";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {MAT_DIALOG_DATA, MatDialogRef} from "@angular/material/dialog";
import {BandService} from "../../../services/band.service";

@Component({
  selector: 'app-band-form',
  templateUrl: './band-form.component.html',
  styleUrls: ['./band-form.component.scss']
})
export class BandFormComponent implements OnInit {
  bandForm!: FormGroup

  constructor(
    private bandService: BandService,
    private fb: FormBuilder,
    public dialogRef: MatDialogRef<BandFormComponent>,
    @Inject(MAT_DIALOG_DATA) public band: Band,
  ) {
  }

  ngOnInit(): void {
    this.initForm();
  }


  initForm(): void {
    this.bandForm = this.fb.group({
      name: [this.band.name, Validators.required],
      origin: [this.band.origin],
      city: [this.band.city],
      startYear: [this.band.startYear, Validators.required],
      endYear: [this.band.endYear],
      foundingMembers: [this.band.foundingMembers],
      membersCount: [this.band.membersCount],
      trend: [this.band.trend],
      summary: [this.band.summary],
    })
  }

  saveBand() {
    if (this.bandForm.valid) {
      console.log('is valid');
      const updatedBand: Band = {...this.band, ...this.bandForm.value};
      this.bandService.patchBand(updatedBand)
      this.dialogRef.close()
    }
  }
}
