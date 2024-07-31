import React from 'react'
import { twMerge } from 'tailwind-merge'

export default function ButtonComponent({ className, href, children, ...props }) {
  const Component = href ? 'a' : 'button'

  return (
    <Component
      className={twMerge('bg-blue-700 text-white font-bold px-4 py-2 rounded hover:bg-blue-800', className)}
      {...props}
    >
      {children}
    </Component>
  )
}