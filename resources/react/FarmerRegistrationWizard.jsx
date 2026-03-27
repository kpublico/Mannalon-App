import React, { useMemo, useState } from 'react';

const STEPS = [
  { key: 'personal', title: 'Personal Info' },
  { key: 'address', title: 'Address' },
  { key: 'farmingProfile', title: 'Farming Profile' },
  { key: 'farmInfo', title: 'Farm Info' },
  { key: 'cropLivestock', title: 'Crop/Livestock' },
  { key: 'resourcesEquipment', title: 'Resources/Equipment' },
  { key: 'financial', title: 'Financial' },
  { key: 'governmentPrograms', title: 'Government Programs' },
  { key: 'documents', title: 'Documents' },
  { key: 'systemInfo', title: 'System Info' },
];

const initialData = {
  firstName: '',
  middleName: '',
  lastName: '',
  gender: '',
  dateOfBirth: '',
  age: '',
  civilStatus: '',
  contactNumber: '',
  email: '',
  governmentIdType: '',
  governmentIdNumber: '',

  region: '',
  province: '',
  municipality: '',
  barangay: '',
  sitioPurok: '',
  gpsLatitude: '',
  gpsLongitude: '',

  farmerType: '',
  yearsInFarming: '',
  primaryOccupation: '',
  secondaryOccupation: '',
  associationName: '',

  farmLocation: '',
  totalSizeHectares: '',
  ownershipType: '',
  parcelCount: '',

  mainCrops: '',
  cropArea: '',
  croppingSeason: '',
  averageYield: '',
  livestockType: '',
  livestockCount: '',

  equipmentOwned: '',
  irrigationType: '',
  waterSource: '',
  fertilizerUsage: '',
  pesticideUsage: '',

  annualIncome: '',
  incomeSources: '',
  hasCreditAccess: false,
  insuranceCoverage: '',

  rsbsaNumber: '',
  distributionLogs: '',
  trainingsAttended: '',
  equipmentSubsidies: '',

  landTitleFile: null,
  validIdFile: null,
  farmPhotosFile: null,
  barangayCertificationFile: null,

  farmerUid: '',
  dateRegistered: '',
  verifiedBy: '',
  accountStatus: 'pending',
};

function StepInput({ label, children }) {
  return (
    <label className="block">
      <span className="mb-1 block text-sm font-medium text-emerald-900">{label}</span>
      {children}
    </label>
  );
}

function TextInput(props) {
  return (
    <input
      {...props}
      className="w-full rounded-lg border border-emerald-200 bg-white px-3 py-2 text-sm text-gray-800 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100"
    />
  );
}

function SelectInput(props) {
  return (
    <select
      {...props}
      className="w-full rounded-lg border border-emerald-200 bg-white px-3 py-2 text-sm text-gray-800 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100"
    />
  );
}

function TextAreaInput(props) {
  return (
    <textarea
      {...props}
      className="w-full rounded-lg border border-emerald-200 bg-white px-3 py-2 text-sm text-gray-800 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100"
    />
  );
}

export default function FarmerRegistrationWizard() {
  const [stepIndex, setStepIndex] = useState(0);
  const [formData, setFormData] = useState(initialData);

  const progress = useMemo(() => ((stepIndex + 1) / STEPS.length) * 100, [stepIndex]);
  const isFirst = stepIndex === 0;
  const isLast = stepIndex === STEPS.length - 1;

  const currentStep = STEPS[stepIndex];

  const updateField = (key, value) => {
    setFormData((prev) => ({ ...prev, [key]: value }));
  };

  const onSubmit = (e) => {
    e.preventDefault();
    console.log('Submit farmer registration payload', formData);
  };

  const renderStep = () => {
    switch (currentStep.key) {
      case 'personal':
        return (
          <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
            <StepInput label="First Name"><TextInput value={formData.firstName} onChange={(e) => updateField('firstName', e.target.value)} /></StepInput>
            <StepInput label="Middle Name"><TextInput value={formData.middleName} onChange={(e) => updateField('middleName', e.target.value)} /></StepInput>
            <StepInput label="Last Name"><TextInput value={formData.lastName} onChange={(e) => updateField('lastName', e.target.value)} /></StepInput>
            <StepInput label="Gender"><SelectInput value={formData.gender} onChange={(e) => updateField('gender', e.target.value)}><option value="">Select</option><option value="male">Male</option><option value="female">Female</option><option value="other">Other</option></SelectInput></StepInput>
            <StepInput label="Date of Birth"><TextInput type="date" value={formData.dateOfBirth} onChange={(e) => updateField('dateOfBirth', e.target.value)} /></StepInput>
            <StepInput label="Age"><TextInput type="number" value={formData.age} onChange={(e) => updateField('age', e.target.value)} /></StepInput>
            <StepInput label="Civil Status"><SelectInput value={formData.civilStatus} onChange={(e) => updateField('civilStatus', e.target.value)}><option value="">Select</option><option value="single">Single</option><option value="married">Married</option><option value="widowed">Widowed</option><option value="separated">Separated</option></SelectInput></StepInput>
            <StepInput label="Contact Number"><TextInput value={formData.contactNumber} onChange={(e) => updateField('contactNumber', e.target.value)} /></StepInput>
            <StepInput label="Email"><TextInput type="email" value={formData.email} onChange={(e) => updateField('email', e.target.value)} /></StepInput>
            <StepInput label="Government ID Type"><TextInput value={formData.governmentIdType} onChange={(e) => updateField('governmentIdType', e.target.value)} /></StepInput>
            <StepInput label="Government ID Number"><TextInput value={formData.governmentIdNumber} onChange={(e) => updateField('governmentIdNumber', e.target.value)} /></StepInput>
          </div>
        );

      case 'address':
        return (
          <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
            <StepInput label="Region"><TextInput value={formData.region} onChange={(e) => updateField('region', e.target.value)} /></StepInput>
            <StepInput label="Province"><TextInput value={formData.province} onChange={(e) => updateField('province', e.target.value)} /></StepInput>
            <StepInput label="Municipality"><TextInput value={formData.municipality} onChange={(e) => updateField('municipality', e.target.value)} /></StepInput>
            <StepInput label="Barangay"><TextInput value={formData.barangay} onChange={(e) => updateField('barangay', e.target.value)} /></StepInput>
            <StepInput label="Sitio/Purok"><TextInput value={formData.sitioPurok} onChange={(e) => updateField('sitioPurok', e.target.value)} /></StepInput>
            <StepInput label="GPS Latitude"><TextInput value={formData.gpsLatitude} onChange={(e) => updateField('gpsLatitude', e.target.value)} /></StepInput>
            <StepInput label="GPS Longitude"><TextInput value={formData.gpsLongitude} onChange={(e) => updateField('gpsLongitude', e.target.value)} /></StepInput>
          </div>
        );

      case 'farmingProfile':
        return (
          <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
            <StepInput label="Type of Farmer"><SelectInput value={formData.farmerType} onChange={(e) => updateField('farmerType', e.target.value)}><option value="">Select</option><option value="owner">Owner</option><option value="tenant">Tenant</option></SelectInput></StepInput>
            <StepInput label="Years in Farming"><TextInput type="number" value={formData.yearsInFarming} onChange={(e) => updateField('yearsInFarming', e.target.value)} /></StepInput>
            <StepInput label="Primary Occupation"><TextInput value={formData.primaryOccupation} onChange={(e) => updateField('primaryOccupation', e.target.value)} /></StepInput>
            <StepInput label="Secondary Occupation"><TextInput value={formData.secondaryOccupation} onChange={(e) => updateField('secondaryOccupation', e.target.value)} /></StepInput>
            <StepInput label="Association/Cooperative"><TextInput value={formData.associationName} onChange={(e) => updateField('associationName', e.target.value)} /></StepInput>
          </div>
        );

      case 'farmInfo':
        return (
          <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
            <StepInput label="Farm Location"><TextInput value={formData.farmLocation} onChange={(e) => updateField('farmLocation', e.target.value)} /></StepInput>
            <StepInput label="Total Size (ha)"><TextInput type="number" value={formData.totalSizeHectares} onChange={(e) => updateField('totalSizeHectares', e.target.value)} /></StepInput>
            <StepInput label="Ownership Type"><SelectInput value={formData.ownershipType} onChange={(e) => updateField('ownershipType', e.target.value)}><option value="">Select</option><option value="owned">Owned</option><option value="leased">Leased</option><option value="shared">Shared</option></SelectInput></StepInput>
            <StepInput label="No. of Parcels/Lots"><TextInput type="number" value={formData.parcelCount} onChange={(e) => updateField('parcelCount', e.target.value)} /></StepInput>
          </div>
        );

      case 'cropLivestock':
        return (
          <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
            <StepInput label="Main Crops"><TextAreaInput rows={3} value={formData.mainCrops} onChange={(e) => updateField('mainCrops', e.target.value)} /></StepInput>
            <StepInput label="Area per Crop"><TextAreaInput rows={3} value={formData.cropArea} onChange={(e) => updateField('cropArea', e.target.value)} /></StepInput>
            <StepInput label="Cropping Season"><SelectInput value={formData.croppingSeason} onChange={(e) => updateField('croppingSeason', e.target.value)}><option value="">Select</option><option value="wet">Wet</option><option value="dry">Dry</option><option value="wet-dry">Wet/Dry</option></SelectInput></StepInput>
            <StepInput label="Average Yield"><TextInput value={formData.averageYield} onChange={(e) => updateField('averageYield', e.target.value)} /></StepInput>
            <StepInput label="Livestock Type"><TextInput value={formData.livestockType} onChange={(e) => updateField('livestockType', e.target.value)} /></StepInput>
            <StepInput label="Head Count"><TextInput type="number" value={formData.livestockCount} onChange={(e) => updateField('livestockCount', e.target.value)} /></StepInput>
          </div>
        );

      case 'resourcesEquipment':
        return (
          <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
            <StepInput label="Owned Equipment"><TextAreaInput rows={3} value={formData.equipmentOwned} onChange={(e) => updateField('equipmentOwned', e.target.value)} /></StepInput>
            <StepInput label="Irrigation Type"><SelectInput value={formData.irrigationType} onChange={(e) => updateField('irrigationType', e.target.value)}><option value="">Select</option><option value="rainfed">Rainfed</option><option value="irrigated">Irrigated</option></SelectInput></StepInput>
            <StepInput label="Water Source"><TextInput value={formData.waterSource} onChange={(e) => updateField('waterSource', e.target.value)} /></StepInput>
            <StepInput label="Fertilizer Usage"><TextInput value={formData.fertilizerUsage} onChange={(e) => updateField('fertilizerUsage', e.target.value)} /></StepInput>
            <StepInput label="Pesticide Usage"><TextInput value={formData.pesticideUsage} onChange={(e) => updateField('pesticideUsage', e.target.value)} /></StepInput>
          </div>
        );

      case 'financial':
        return (
          <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
            <StepInput label="Avg Annual Income"><TextInput type="number" value={formData.annualIncome} onChange={(e) => updateField('annualIncome', e.target.value)} /></StepInput>
            <StepInput label="Income Sources"><TextInput value={formData.incomeSources} onChange={(e) => updateField('incomeSources', e.target.value)} /></StepInput>
            <StepInput label="Access to Credit/Loan"><label className="mt-2 inline-flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" checked={formData.hasCreditAccess} onChange={(e) => updateField('hasCreditAccess', e.target.checked)} /> Yes</label></StepInput>
            <StepInput label="PCIC Insurance Coverage"><TextInput value={formData.insuranceCoverage} onChange={(e) => updateField('insuranceCoverage', e.target.value)} /></StepInput>
          </div>
        );

      case 'governmentPrograms':
        return (
          <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
            <StepInput label="RSBSA Registration Number"><TextInput value={formData.rsbsaNumber} onChange={(e) => updateField('rsbsaNumber', e.target.value)} /></StepInput>
            <StepInput label="Distribution Logs"><TextAreaInput rows={3} value={formData.distributionLogs} onChange={(e) => updateField('distributionLogs', e.target.value)} /></StepInput>
            <StepInput label="Trainings Attended"><TextAreaInput rows={3} value={formData.trainingsAttended} onChange={(e) => updateField('trainingsAttended', e.target.value)} /></StepInput>
            <StepInput label="Equipment Subsidies"><TextAreaInput rows={3} value={formData.equipmentSubsidies} onChange={(e) => updateField('equipmentSubsidies', e.target.value)} /></StepInput>
          </div>
        );

      case 'documents':
        return (
          <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
            <StepInput label="Land Title"><TextInput type="file" onChange={(e) => updateField('landTitleFile', e.target.files?.[0] || null)} /></StepInput>
            <StepInput label="Valid ID"><TextInput type="file" onChange={(e) => updateField('validIdFile', e.target.files?.[0] || null)} /></StepInput>
            <StepInput label="Farm Photos"><TextInput type="file" onChange={(e) => updateField('farmPhotosFile', e.target.files?.[0] || null)} /></StepInput>
            <StepInput label="Barangay Certification"><TextInput type="file" onChange={(e) => updateField('barangayCertificationFile', e.target.files?.[0] || null)} /></StepInput>
          </div>
        );

      case 'systemInfo':
        return (
          <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
            <StepInput label="Farmer ID (UID)"><TextInput value={formData.farmerUid} onChange={(e) => updateField('farmerUid', e.target.value)} /></StepInput>
            <StepInput label="Date Registered"><TextInput type="date" value={formData.dateRegistered} onChange={(e) => updateField('dateRegistered', e.target.value)} /></StepInput>
            <StepInput label="Verified By"><TextInput value={formData.verifiedBy} onChange={(e) => updateField('verifiedBy', e.target.value)} /></StepInput>
            <StepInput label="Account Status"><SelectInput value={formData.accountStatus} onChange={(e) => updateField('accountStatus', e.target.value)}><option value="pending">Pending</option><option value="active">Active</option><option value="verified">Verified</option></SelectInput></StepInput>
          </div>
        );

      default:
        return null;
    }
  };

  return (
    <div className="min-h-screen bg-gray-50 px-4 py-10">
      <div className="mx-auto max-w-5xl">
        <div className="mb-4 rounded-xl border border-emerald-100 bg-white p-4 shadow-sm">
          <div className="mb-2 flex items-center justify-between text-sm text-emerald-900">
            <span className="font-semibold">MannalonApp Farmer Registration</span>
            <span>Step {stepIndex + 1} of {STEPS.length}</span>
          </div>
          <div className="h-2 w-full rounded-full bg-emerald-100">
            <div className="h-2 rounded-full bg-emerald-600 transition-all" style={{ width: `${progress}%` }} />
          </div>
        </div>

        <form onSubmit={onSubmit} className="rounded-2xl border border-emerald-100 bg-white p-6 shadow-md">
          <div className="mb-6 border-b border-emerald-100 pb-4">
            <h2 className="text-xl font-bold text-emerald-900">{currentStep.title}</h2>
            <p className="mt-1 text-sm text-gray-500">Fill out this category to continue.</p>
          </div>

          {renderStep()}

          <div className="mt-8 flex items-center justify-between gap-3">
            <button
              type="button"
              onClick={() => setStepIndex((prev) => Math.max(prev - 1, 0))}
              disabled={isFirst}
              className="rounded-lg border border-emerald-300 px-4 py-2 text-sm font-semibold text-emerald-700 disabled:cursor-not-allowed disabled:opacity-40"
            >
              Back
            </button>

            {isLast ? (
              <button
                type="submit"
                className="rounded-lg bg-emerald-600 px-5 py-2 text-sm font-semibold text-white hover:bg-emerald-700"
              >
                Submit Registration
              </button>
            ) : (
              <button
                type="button"
                onClick={() => setStepIndex((prev) => Math.min(prev + 1, STEPS.length - 1))}
                className="rounded-lg bg-emerald-600 px-5 py-2 text-sm font-semibold text-white hover:bg-emerald-700"
              >
                Next
              </button>
            )}
          </div>
        </form>
      </div>
    </div>
  );
}
