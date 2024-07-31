import React from 'react'
import { twMerge } from 'tailwind-merge'

export default function ContainerComponent({ className, children, ...props }) {
  return (
    <div
      className={twMerge('px-6 w-full max-w-xl mx-auto bg-blue-100 rounded-xl shadow-xl', className)}
      {...props}
    >
      {children}
    </div>
  )
}