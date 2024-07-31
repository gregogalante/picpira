import React from 'react'
import { twMerge } from 'tailwind-merge'

export default function AlertComponent({ className, type, children, ...props }) {
  const genericClasses = 'px-4 py-3 rounded'
  const typeClasses = {
    success: 'bg-green-100 text-green-900',
    error: 'bg-red-100 text-red-900',
    warning: 'bg-yellow-100 text-yellow-900',
    info: 'bg-blue-100 text-blue-900'
  }

  return (
    <div
      className={twMerge(genericClasses, typeClasses[type], className)}
      {...props}
    >
      {children}
    </div>
  )
}