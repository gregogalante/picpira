import React from 'react'
import { twMerge } from 'tailwind-merge'

export default function InputComponent({ label, id, className, ...props }) {
  return (
    <div
      className={twMerge('text-left', className)}
    >
      {label && (
        <label
          htmlFor={id}
          className={twMerge('block font-medium text-gray-800')}
        >
          {label}
        </label>
      )}
      <input
        className={twMerge('mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm')}
        {...props}
      />
    </div>
  )
}