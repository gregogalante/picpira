import React from 'react'
import { twMerge } from 'tailwind-merge'

export default function TitleComponent({ className, children, ...props }) {
  return (
    <div
      className={twMerge('font-bold text-4xl', className)}
      {...props}
    >
      {children}
    </div>
  )
}